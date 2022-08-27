#!/bin/bash

SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

# shellcheck disable=SC2164
cd "$SCRIPT_DIR"

GIT_STATUS=$(git status)

CURRENT_BRANCH=$(git branch | grep "*" | awk '{gsub("* ",""); print}')

echo "Current branch: $CURRENT_BRANCH"

already_up_to_date="Already up to date."
modified="modified:"

if [[ $GIT_STATUS =~ $modified ]]; then
    git reset --hard "origin/$CURRENT_BRANCH"
fi

GIT_PULL=$(git pull)

if [[ $GIT_PULL =~ $already_up_to_date ]]; then
    echo "$already_up_to_date"
    exit
fi

GIT_PULL_TRY_2=$(git pull)

if [[ ! ($GIT_PULL_TRY_2 =~ $already_up_to_date) ]]; then
    echo "Can't pull changes"

    echo "$GIT_PULL_TRY_2"

    exit
fi

changed_files="$(cd .. && git diff-tree -r --name-only --no-commit-id ORIG_HEAD HEAD)"

check_run() {
	echo "$changed_files" | grep --quiet "$1" && eval "$2"
}

# In this example it's used to run `npm install` if package.json changed
check_run package.json "npm install"
check_run composer.json "composer install"

composer dump-autoload -o

php artisan migrate
#php artisan octane:reload
php artisan queue:restart
#php artisan scribe:generate

npm run build
