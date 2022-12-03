### 更新系统、安装软件（拷贝以下命令一次性粘贴）
yum -y update
yum -y install httpd mod_ssl svn git
systemctl enable httpd.service
yum -y install epel-release
rpm -Uvh http://rpms.remirepo.net/enterprise/remi-release-7.rpm
yum -y install yum-utils
yum-config-manager --enable remi-php74
yum -y install php php-devel php-pdo php-mysql php-mbstring php-pecl-redis php-gd php-bcmath php-zip php-xml


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
