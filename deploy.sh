#!/bin/sh
# Script to make a deployment
echo Starting deployment.
git status
git checkout 3.0/master
git add .
composer update
git commit -m "ci: update lockfile"
git push origin