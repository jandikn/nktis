Stavy projektù:
0 poptávka
1 aktulní
2 nevyfakturovaný
3 nezaplacený
4 nevyútovaný
5 archív
6 zrušený
7 nevymahatelný
8 nevyúètovatelný

Zmìny stavù ve staré DB:
1 -> 3
2 -> 4
3 -> 5
4 -> 6

Databáze zmìny:
state -> status
town -> city
end -> deadline
cost -> price

- vytvoøení cizích klíèù, promázání chybných záznamù, které nelze mezi tabulkami prolinkovat
	-> alter table 'project' add foreign key (customer_id) references 'customer' ('id');

- zrušení tabulky 'target_language' a 'target_language_id' pøidat do tabulky 'translator_project'

- pøehodnotit závislost tabulky 'invoice' a 'project'

- nové sloupce: 
	pøekladatel: datum vytvoøení, datum deaktivace, studium (škola, obor)
	projekt: poèet NS, sleva a její typ, pøíplatek a jeho typ