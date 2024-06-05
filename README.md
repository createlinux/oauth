# oauth
oauth2.0 client package

在.env里配置以下参数
```text
#客户端id
LITCHI_AUTH_CLIENT_ID=
#客户端秘钥
LITCHI_AUTH_CLIENT_SECRET=
#认证服务器服务器端url，正式 https://accounts-api.lizhiruanjian.com
LITCHI_AUTH_SERVER_APP_URL=q
#认证服务器客户端端url，正式 https://accounts.lizhiruanjian.com
LITCHI_AUTH_CLIENT_APP_URL=
#应用回调地址
LITCHI_AUTH_CLIENT_REDIRECT_URI=
```

客户端代码示例，如果存在cookie内使用以下代码，如果存在localStorage则需要修改响应体
```php
public function store(Request $request)
    {
        $code = $request->post('code');

        $oauthClient = create_litchi_oauth_client();

        if (!$code) {
            //build redirect url
            return Http::created("ok", [
                'redirect_uri' => $oauthClient->generateAuthCodeURI()
            ]);
        }

        $response = $oauthClient->createNewAuthToken($code);

        if (!$response->isSuccess()) {
            return Http::badRequest($response->getMessage());
        }

        return Http::created(context: [
            'access_token' => Crypt::encrypt($response->getAccessToken())
        ])->withCookie(
            cookie(
                'access_token',
                Crypt::encrypt($response->getAccessToken()),
                $response->getExpirationSeconds() / 60
            )
        );
    }
```
清除token示例，如果存在cookie内使用以下代码，如果存在localStorage则需要修改响应体
```php
    public function destroy(Request $request, $me)
    {
        $accessToken = Cookie::get('access_token');
        $cookie = cookie(
            'access_token',
            null,
            -1
        );
        if (!$accessToken) {
            return Http::deleted('退出登录成功')->withCookie($cookie);
        }

        $oauthClient = create_litchi_oauth_client();
        $response = $oauthClient->removeAccessToken(Crypt::decrypt($accessToken));
        if (!$response->isSuccess()) {
            return Http::badRequest($response->getMessage());
        }

        return Http::deleted('退出登录成功')->withCookie($cookie);
    }

```