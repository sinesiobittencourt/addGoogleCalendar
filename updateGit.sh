#!/usr/bin/env bash


#https://github.com/sinesiobittencourt/roleta
git pull origin master
echo "*** Update git done. ***"
git add *
git commit -m 'Update'
echo "*** Update git done. ***"
git push origin master
