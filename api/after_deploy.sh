#!/bin/bash
# Before Deply Script
# By Eduardo Sirangelo
# 09/09/2015
#

echo "--- INICIO";

echo "--- Setando caminho absoluto do Diretorio";
dir="/usr/share/nginx/html/api.leandrostormer.com/public_html";

echo "--- Executando Composer update";
composer update -q -d "$dir";

echo "--- FIM";