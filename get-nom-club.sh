#!/bin/bash
for (( i=1; i<=186; i++ ))
do
curl https://www.ffjudo.com/lesclubs/liste/$i | grep "<a href=" | cut -d " " -f2 | grep club- | cut -d ">" -f1 | grep 'com/club-' | cut -d "." -f3 | cut -d "/" -f2 | grep -o '[A-Za-z,-]*' | cut -d "-" -f2,3,4,5,6,7,8,9 > clubs/clubs-page$i.csv
done
