--------------图腾贷线下业务管理系统目录结构
|
|---doc 项目文档和数据库文件
|---ui 项目UI设计前端
|  |--html
|  |   |--MOBILE-HTML:移动端页面
|  |   |--WEB-HTML :WEB页面
|  |--原型图
|  |--设计图
|  |--素材
|  |--psd。UI界面
|
|---web 项目核心文件
|  |--com_party 公共业务逻辑
|  |   |--helper 公共辅助函数
|  |   |--libraries 公共类库
|  |   |--models 业务逻辑model
|
|  |--framework CI框架
|  |   |--core CI核心类
|  |   |--database CI数据库处理
|  |   |--fonts
|  |   |--helpers
|  |   |--language
|  |   |--libraries
|
|  |--manage 项目管理后台
|  |   |--application 项目应用目录
|  |   |  |--core 项目控制器最高基类
|  |   |  |--controllers 控制器
|  |   |  |--view 视图层
|  |   |  |--config 配置文件
|  |   |  |  |--privilege.php权限配置文件
|  |   |  |  |--role.php 角色配置文件
|  |   |--assets 静态资源文件
|  |   |  |--css
|  |   |  |--images
|  |   |  |--js
|  |   |  |--plugins 存放独立的js插件相关文件
|  |   |--data 用来存放，上传的图片或者是验证码文件之类的
|  |   |--index.php项目入口
|
|  |--mobile 移动端项目文件
|  |   |--application 项目应用目录
|  |   |  |--core 项目控制器最高基类
|  |   |  |--controllers 控制器
|  |   |  |--view 视图层
|  |   |  |--config 配置文件
|  |   |  |  |--privilege.php权限配置文件
|  |   |  |  |--role.php 角色配置文件
|  |   |--assets 静态资源文件
|  |   |  |--css
|  |   |  |--images
|  |   |  |--js
|  |   |  |--plugins 存放独立的js插件相关文件
|  |   |--data 用来存放，上传的图片或者是验证码文件之类的
|  |   |--index.php
|
|  |--www PC端web项目文件
|  |   |--application 项目应用目录
|  |   |  |--core 项目控制器最高基类
|  |   |  |--controllers 控制器
|  |   |  |--view 视图层
|  |   |  |--config 配置文件
|  |   |  |  |--privilege.php权限配置文件
|  |   |  |  |--role.php 角色配置文件
|  |   |--assets 静态资源文件
|  |   |  |--css
|  |   |  |--images
|  |   |  |--js
|  |   |  |--plugins 存放独立的js插件相关文件
|  |   |--data 用来存放，上传的图片或者是验证码文件之类的
|  |   |--index.php项目入口
|
|

[PHPWEB]  // 系统根目录
    |--Api         // 接口文件目录
    |--Apps        // 应用模块目录
    |--Core        // 核心框架目录（建议将框架放置在网站目录外，安全）
    |--Doc         // 项目相关文档目录
    |--Data        // 数据文件存放目录
    |--Runtime     // 系统运行时文件目录
    |--Statics     //（或者Public)静态资源包
        |--css         // css文件存放目录
            |--img         // css中用到的图片文件存放目录
        |--images      // 所有图片文件存放路径（在里面根据目录结构设立子目录） 
        |--js          // js脚本存放目录
    |--theme       // 主题目录
        |--default     // 默认主题目录
        |--...         // 其他主题目录
    |--Uploads     // 上传文件目录
    |--crossdomain.xml      // FLASH跨域传输文件
    |--robots.txt           // 搜索引擎蜘蛛限制配置文件
    |--favicon.ico          // 系统icon图标






