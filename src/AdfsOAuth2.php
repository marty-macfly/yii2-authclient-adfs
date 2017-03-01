<?php
namespace macfly\authclient;

use Yii;
use yii\authclient\OAuth2;
use yii\web\HttpException;

use Emarref\Jwt\Jwt;

class AdfsOAuth2 extends OAuth2
{
	public $xoauthDisplayname	= null;
	public $resource					= null;

  /**
   * @inheritdoc
   */
  protected function initUserAttributes()
  {
    $jwt    = new Jwt();
    $token  = $jwt->deserialize($this->getAccessToken()->getToken());
    return json_decode($token->getPayload()->jsonSerialize(), true);
  }

  /**
   * @inheritdoc
   */
  public function buildAuthUrl(array $params = [])
  {
    $returnUrl      = $this->getReturnUrl();
    $defaultParams  = [
				'resource'						=> substr($returnUrl, 0, strpos($returnUrl, '?')),
				'xoauth_displayname'	=> $this->getXoauthDisplayname(),
			];

    return parent::buildAuthUrl(array_merge($defaultParams, $params));
  }

	protected function getXoauthDisplayname()
  {
		return is_null($this->xoauthDisplayname) ? Yii::$app->name : $this->xoauthDisplayname;
  }

  /**
   * @inheritdoc
   */
  public function getEmail()
  {
    return isset($this->getUserAttributes()['email'])
      ? $this->getUserAttributes()['email']
      : null;
  }

  /**
   * @inheritdoc
   */
  public function getUsername()
  {
    return isset($this->getUserAttributes()['username'])
      ? $this->getUserAttributes()['username']
      : null;
  }

  /**
   * @inheritdoc
   */
  protected function defaultName()
  {
		return 'adfsoauth2';
  }

  /**
   * @inheritdoc
   */
  protected function defaultTitle()
  {
		return 'AdfsOAuth2';
  }
}
