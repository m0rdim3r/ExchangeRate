#!/usr/bin/env bash

COMMAND="composer $@"

su -s /bin/bash www-data -p -c "$COMMAND"