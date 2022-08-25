#!/bin/sh
# Script to make a deployment
echo Starting deployment.
git pull
git status
git checkout 3.0/master
composer update
git add .
git commit -m "ci: update lockfile"
git push origin