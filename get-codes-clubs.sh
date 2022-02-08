#!/bin/bash
for (( i=1; i<=3; i++ ))
do
curl https://www.ffjudo.com/lesclubs/liste/$i | grep "<a href=" | cut -d " " -f2 | grep club- | cut -d ">" -f1 | grep -o '[0-9]*' > page$i.csv 
done
