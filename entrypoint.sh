#!/usr/bin/env bash
if [[ $1 == "" ]]; then
  cp .env.${ENV_FILE} .env && php ./bin/hyperf.php start
else
  cd /hyperf
  if [[ $1 == "update" ]]; then
    if [[ -f "composer.json" ]]; then
      echo -e "👉 Updating Composer Vendor ... "
      composer update --no-plugins --no-scripts --no-dev -vvv && composer dump-autoload -o
    else
      echo -e "[x] Not found composer.json ... "
    fi
  fi

  if [[ $1 == "start" ]]; then
    if [[ ! -f "composer.json" ]]; then
      echo -e "[x] Not found composer.json ... "
    else
      if [[ ! -d "vendor" ]]; then
        composer update --no-plugins --no-scripts --no-dev -vvv && composer dump-autoload -o
      fi
    fi
    cp .env.${ENV_FILE} .env
    if [[ -d "vendor" && -f ".env" ]]; then
      echo -e "👉 Running ..."
      if [[ ! -d "runtime" ]]; then
        mkdir -m 755 runtime
      fi
      if [[ ! -d "public" ]]; then
        mkdir -m 755 public
      fi
      rm -rf runtime/container && php ./bin/hyperf.php start
    else
      echo -e "[x] Not found vendor dir or .env file"
    fi
  fi
fi
