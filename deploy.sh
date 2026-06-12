#!/bin/bash
set -e

cd /home/danks/repositories/DanksAndStrydom

git pull origin main

rm -rf /home/danks/public_html/build
cp -R /home/danks/repositories/DanksAndStrydom/public/build /home/danks/public_html/build