#!/bin/bash

if [ "$TRAVIS_BRANCH" != "DevBranch" ]; then 
    exit 0;
fi

export GIT_COMMITTER_EMAIL="antoton@gmail.com"
export GIT_COMMITTER_NAME="antoton"

git checkout master || exit
git merge "$TRAVIS_COMMIT" || exit
git push https://antoton:azertyuiop1591@AP-Elektronica-ICT/PM19-pm1912.git