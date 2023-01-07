### 更新系统、安装软件（拷贝以下命令一次性粘贴）
yum -y update
yum -y install  mod_ssl svn git

###安装nginx
wget  https://nginx.org/packages/centos/7/x86_64/RPMS/nginx-1.20.2-1.el7.ngx.x86_64.rpm
rpm -ivh nginx-1.20.2-1.el7.ngx.x86_64.rpm
systemctl start nginx
systemctl enable nginx


###安装php
yum -y install epel-release
rpm -Uvh http://rpms.remirepo.net/enterprise/remi-release-7.rpm
yum -y install yum-utils
yum-config-manager --enable remi-php74
yum -y install php php-devel php-pdo php-mysql php-mbstring php-pecl-redis php-gd php-bcmath php-zip php-xml


### 安装mysql 来源网址: https://blog.csdn.net/qq_56047419/article/details/127211781
wget https://dev.mysql.com/get/mysql80-community-release-el8-1.noarch.rpm
yum install mysql80-community-release-el8-1.noarch.rpm
yum install -y mysql-server --nogpgcheck
systemctl enable mysqld.service
systemctl start mysqld.service
### 查看默认密码
grep 'temporary password' /var/log/mysqld.log
### 登录
docker exec -it mysql /bin/bash
mysql -uroot -p
### 设置密码及加密格式(密码不能过于简单,包含大小写字母数字下划线)
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'Wyt_199999';
FLUSH PRIVILEGES;
### 查看Mysql-Server 用户配置
SELECT User, Password, Host FROM user;
use mysql;
### 设置其他ip也能访问：现在只能本机
update user set host='%' where user='root';
quit;
systemctl stop mysqld.service
systemctl start mysqld.service


### 开启redis并设置开机自启
yum -y install redis
systemctl start redis
systemctl enable redis

### 安装supervisor http://t.zoukankan.com/jkko123-p-10846038.html

### 使用sftp上传"deploy/centos7/"目录下对应文件到centos7.x服务器

### 从git下载代码
git clone https://github.com/wyt-gh/createdream.git /www/createdream
### 输入以上命令后第一个提示"直接回车"，然后使用阿里云专用svn账号和密码

### 设置runtime目录权限，该目录已从svn中去除，需要先创建
mkdir -m 777 /www/createdream/runtime

### 重启服务器
reboot
### 部署完毕
