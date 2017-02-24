# yii2-authclient-adfs
Adfs client for yii2-authclient

## Installation
Through Composer
From console:
```
composer require brainsrage/yii2-authclient-instagram
```
or add to "require" section to composer.json
```
"brainsrage/yii2-authclient-instagram": "dev-master"
```
##Usage
Set up Oauth2 single sign-on on Active Directory with ADFS.
And add the AdfsOauth2 client to your auth clients.

```
php
'components' => [
    'authClientCollection' => [
      'class'   => \yii\authclient\Collection::className(),
      'clients' => [
        'adfs' => [
          'class'             => 'macfly\authclient\AdfsOAuth2',
          'authUrl'           => 'https://adfs.microsoft.com/adfs/oauth2/authorize',
          'tokenUrl'          => 'https://adfs.microsoft.com/adfs/oauth2/token',
          'clientId'          => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
          'clientSecret'      => 'yyyyyyyyy',
          'userAttributes'    => [
            'email',
          ],
        ],
        // other clients
      ],
    ],
    // ...
 ]
```
