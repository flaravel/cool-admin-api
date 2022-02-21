
当第一眼看到 [Cool-Admin](https://github.com/cool-team-official/cool-admin-vue) 就被它的颜值惊艳到了

![image.png](https://cdn.learnku.com/uploads/images/202202/22/30430/U1ZpcEn2NW.png!large)

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

### 生成jwt密钥
`php artisan jwt:secret`

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

![img_1.png](http://wxlib-dev.oss-cn-shanghai.aliyuncs.com/dev/ly6SzTx7EUUdPB3sBOfKKgnaWjmeV3N9eIf081Ga.png)


### 演示地址

http://119.29.159.240:8001

管理员:

- admin
- password

测试:
- test
- password
