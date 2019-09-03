#!/usr/bin/env bash


git pull origin master
echo "*** Update git done. ***"
git add *
git commit -m 'Update'
echo "*** Update git done. ***"
git push origin master

git config --global credential.helper "cache --timeout 7200"