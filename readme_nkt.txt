Stavy projekt�:
0 popt�vka
1 aktuln�
2 nevyfakturovan�
3 nezaplacen�
4 nevy�tovan�
5 arch�v
6 zru�en�
7 nevymahateln�
8 nevy��tovateln�

Zm�ny stav� ve star� DB:
1 -> 3
2 -> 4
3 -> 5
4 -> 6

Datab�ze zm�ny:
state -> status
town -> city
end -> deadline
cost -> price

- vytvo�en� ciz�ch kl���, prom�z�n� chybn�ch z�znam�, kter� nelze mezi tabulkami prolinkovat
	-> alter table 'project' add foreign key (customer_id) references 'customer' ('id');

- zru�en� tabulky 'target_language' a 'target_language_id' p�idat do tabulky 'translator_project'

- p�ehodnotit z�vislost tabulky 'invoice' a 'project'

- nov� sloupce: 
	p�ekladatel: datum vytvo�en�, datum deaktivace, studium (�kola, obor)
	projekt: po�et NS, sleva a jej� typ, p��platek a jeho typ