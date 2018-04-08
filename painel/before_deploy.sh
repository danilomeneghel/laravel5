#!/bin/bash
# Before Deply Script
# By Eduardo Sirangelo
# 09/09/2015
#

echo "--- INICIO";

echo "--- Setando caminho absoluto do Diretorio";
dir="/usr/share/nginx/html/painel-s.leandrostormer.com.br";

echo "--- Carregando Owner em $dir";
owner=`ls -ld $dir | awk '{print $3}'`;

echo "--- Carregando Group em $dir";
group=`ls -ld $dir | awk '{print $4}'`;

echo "--- Aplicando permissoes 0775 em $dir"
`chmod -R 0775 $dir`;

echo "--- Setando Onwer($owner) e Group($group) em $dir";
`chown -R  $owner.$group $dir`;

echo "--- Aplicando permissoes 0777 em $dir/storage e $dir/bootstrap/cache";
`chmod -R 0777 $dir/storage`;
`chmod -R 0777 $dir/bootstrap/cache`;

echo "--- FIM";