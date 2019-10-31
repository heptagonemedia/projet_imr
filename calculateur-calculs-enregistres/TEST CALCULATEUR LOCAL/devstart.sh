#!/usr/bin/env bash
#psql -Uheptagonemedia -dimr -hvpsloic.loicbertrand.net -p1132
echo "Connexion en tant qu\'\"userLambda\""
psql -UuserLambda -dprojet_imr -hlocalhost -p5432
