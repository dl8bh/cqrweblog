#!/bin/bash
cp $1 $1.tmp
sed -i s/"%"/"[A-Z]"/g $1.tmp
sed -i s/"#"/"[0-9]"/g $1.tmp
sed -i s/"|"/"#"/g $1.tmp
cut -d "#" -f 1 $1.tmp > pre.tmp
cut -d "#" -f 1 --complement $1.tmp > suf.tmp
sed -i 's/ \+#/#/g' pre.tmp
sed -i 's/ \+/|^/g' pre.tmp
sed -i 's/.*/&#/g' pre.tmp

sed -i s/" "/""/g pre.tmp
sed -i s/"|^#"/#/g pre.tmp
paste pre.tmp suf.tmp > $1.tmp
sed -i 's/\t//g' $1.tmp
sed -i 's/^/^/' $1.tmp
grep -v \#.*\#.*\#.*\#.*\#.*\#.*\#.*\#.*-[0-9][0-9][0-9] $1.tmp > $1.tmp.1&& mv $1.tmp.1 $1.tmp
grep =.*# $1.tmp > $1.single.tmp
grep -v =.*# $1.tmp > $1.tmp.1&& mv $1.tmp.1 $1.tmp

sed -i s/"="/"#"/g $1.tmp
sed -i 's/-$/-#/g' $1.tmp

cut -d "#" -f 1 $1.single.tmp > pre.tmp
cut -d "#" -f 1 --complement $1.single.tmp > suf.tmp
#sed -i 's/^^\=/^/g' pre.tmp
#sed -i s/"="/"|"/g pre.tmp
sed -i s/"="//g pre.tmp
sed -i s/"="/"#"/g suf.tmp
sed -i s/R$/R\#/g suf.tmp
sed -i 's/.*/&#/g' pre.tmp

paste -d "" pre.tmp suf.tmp > $1.single.tmp

cut -c 2 $1.tmp > $1.first.tmp
cut -c 2 $1.single.tmp > $1.first.single.tmp
sed -i 's/$/#/g' $1.first.tmp
sed -i 's/$/#/g' $1.first.single.tmp
cp -p $1.single.tmp $1.single.tmp.1
cp -p $1.tmp $1.tmp.1
paste -d "" $1.first.single.tmp $1.single.tmp.1 > $1.single.tmp
paste -d "" $1.first.tmp $1.tmp.1 > $1.tmp

cat country.head $1.tmp > $1.csv
cat country.head $1.single.tmp > $1.single.csv
rm pre.tmp suf.tmp $1.single.tmp* $1.tmp* 
rm *.tmp*
