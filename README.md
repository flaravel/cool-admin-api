
当第一眼看到 [Cool-Admin](https://github.com/cool-team-official/cool-admin-vue) 就被它的颜值惊艳到了

官方只有node和java版本的server api，于是基于Laravel做了权限管理模块

### 安装

`compose require flaravel/cool-admin-api`

### 配置文件

`php artisan vendor:publish --tag=cool-admin`

### 迁移
`php artisan migrate`

### 初始化数据
`php artisan vendor:publish --tag=cool-seeder`

`php artisan db:seed --class=CoolAdminSeeder`

### 前端

github: https://github.com/flaravel/cool-admin-vue

代码拉取下来之后更改代理配置（在 vite.config.ts文件 中）, 更改成当前你的后面请求地址

```js
const proxy = {
    "/dev": {
        target: "请求服务端的url",
        changeOrigin: true,
        rewrite: (path: string) => path.replace(/^\/dev/, "")
    },

    "/pro": {
        target: "https://show.cool-admin.com",
        changeOrigin: true,
        rewrite: (path: string) => path.replace(/^\/pro/, "/api")
    }
};
```

更改完运行就能看到如下界面:

![img_1.png](https://camo.githubusercontent.com/8da14571f9e7169a6a542113f0b410c1662f44a9ab1c74bbfa6d2b9604932307/68747470733a2f2f636f6f6c2d73686f772e6f73732d636e2d7368616e676861692e616c6979756e63732e636f6d2f61646d696e2f686f6d652d6d696e692e706e67)
