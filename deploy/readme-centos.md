### 更新系统、安装软件（拷贝以下命令一次性粘贴）
yum -y update
yum -y install httpd mod_ssl svn git
systemctl enable httpd.service
yum -y install epel-release
rpm -Uvh http://rpms.remirepo.net/enterprise/remi-release-7.rpm
yum -y install yum-utils
yum-config-manager --enable remi-php74
yum -y install php php-devel php-pdo php-mysql php-mbstring php-pecl-redis php-gd php-bcmath php-zip php-xml redis

### 安装mysql 来源网址: https://blog.csdn.net/qq_56047419/article/details/127211781
### 添加 rpm 源
wget https://dev.mysql.com/get/mysql80-community-release-el8-1.noarch.rpm
### 下载的 rpm 文件
yum install mysql80-community-release-el8-1.noarch.rpm
yum install -y mysql-server --nogpgcheck
### 查看当前是否为开机服务
systemctl list-unit-files | grep mysql
### 不是的话设置为开机启动
systemctl enable mysqld.service
systemctl start mysqld.service
### 查看当前是否启动 MySQL 服务
ps -ef | grep mysql
### 查看默认密码
grep 'temporary password' /var/log/mysqld.log
### 登录
mysql -uroot -p
### 设置密码及加密格式(密码不能过于简单,包含大小写字母数字下划线)
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'Wyt_199999';
### 刷新
FLUSH PRIVILEGES;
### 查看Mysql-Server 用户配置
SELECT User, Password, Host FROM user;
### 进入mysql
use mysql;
### 设置其他ip也能访问：现在只能本机
update user set host='%' where user='root';
quit;
### 完成了可以关闭了再启动：
systemctl stop mysqld.service
systemctl start mysqld.service

### 开启redis并设置开机自启
systemctl start redis
systemctl enable redis

### 安装supervisor http://t.zoukankan.com/jkko123-p-10846038.html

### 使用sftp上传"deploy/centos7/"目录下所有文件到centos7.x服务器

### "/etc/httpd/conf/httpd.conf"文件增加"ServerName localhost:80"，一般搜索"ServerName"，写在"#ServerName www.example.com:80"下方
### 或者直接执行以下命令
echo "ServerName localhost:80" >> /etc/httpd/conf/httpd.conf
### httpd.conf中LogFormat增加记录真实ip，\"%{X-FORWARDED-FOR}i\"
LogFormat "%h \"%{X-FORWARDED-FOR}i\" %l %u %t \"%r\" %>s %b \"%{Referer}i\" \"%{User-Agent}i\"" combined


### 从git下载代码
git clone https://github.com/wyt-gh/createdream.git /www/createdream
### 输入以上命令后第一个提示"直接回车"，然后使用阿里云专用svn账号和密码

### 设置runtime目录权限，该目录已从svn中去除，需要先创建
mkdir -m 777 /www/createdream/runtime

### 重启服务器
reboot
### 部署完毕
