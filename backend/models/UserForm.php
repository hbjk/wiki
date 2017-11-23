<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * User form
 */
class UserForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $verifyCode;
    public $attempts = 5;
    public $counter;
    public $search;
    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'match', 'pattern'=>'/^[a-zA-Z]{1}[0-9a-zA-Z_]{1,}$/', 'message' => '用户名格式不正确'],
            ['password', 'required', 'message' => '请填写密码'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword', 'message'=>'密码格式不正确'],
            ['verifyCode', 'captcha', 'captchaAction' => 'be/captcha', 'on'=>'captchaRequired', 'message' => '验证码不正确'],
            ['search', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'rememberMe' => '记住一周',
            'verifyCode' => '验证码',
            'search' => '关键字'
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '用户名或密码不正确');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        Yii::$app->user->on(\yii\web\User::EVENT_BEFORE_LOGIN, [$this->getUser(), 'generateAuthKey',]);
        if($this->validate() && Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 7 : 0)) {
            Yii::$app->session->remove('loginCaptchaRequired');
            return true;
        } else {
            $this->counter = Yii::$app->session->get('loginCaptchaRequired') + 1;
            Yii::$app->session->set('loginCaptchaRequired', $this->counter);
            if ($this->counter >= $this->attempts) {
                $this->setScenario("captchaRequired");
            }
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
