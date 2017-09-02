# Target Laravel project:

- First I've created target Laravel project where I test my package
- I use adminlte-laravel:
- Script: adminlte TODO create Gist:

```
$ which adminlte 
 or 

$ cat ~/.zshrc

adminlte () {
	cd ~/Code
	laravel new $1
	cd $1
	adminlte-laravel install
	llum boot
	yarn
	phpstorm .
	llum github:init
}

```

# Laravel Package
- Template phpleague/skeleton:
  - git clone git@github.com:thephpleague/skeleton.git {packagename}
  
Commands:
```  
  git clone git@github.com:thephpleague/skeleton.git staff
  cd staff
  rm -rf .git
  git init
  php ./prefill.php
  git add .
  git commit -a -m "First version using phpleague skeleton"
```

Create Github repo and:

```
  git remote add origin git@github.com:acacha-scool/staff.git
  git pull origin master
  git push origin master
  
```

# Connect packages with studio

Install studio:

 https://github.com/franzliedke/studio
 
Global installation is good:

```
composer global require franzl/studio
```
 
Execute:

```
composer update acacha-scool/staff
```
 See:
  
```
 [Studio] Loading path /home/sergi/Code/acacha-scool/staff/staff
 Loading composer repositories with package information
 Updating dependencies (including require-dev)
 Package operations: 1 install, 0 updates, 0 removals
   - Installing acacha-scool/staff (dev-master): Symlinking from /home/sergi/Code/acacha-scool/staff/staff
 ...
```

Most important think the simlynk is created no need to push repo to Composer...

# Customizing PhpLeague skeleton to Laravel package

