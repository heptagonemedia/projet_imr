#  Laravel:

## Connections:

Le fichier de configuration de la base de données se situe dans **config/database.php**:

	* on y définie les connexions et celles qui doivent être utilisées par défaut



## Faire des requêtes :

		### 		Faire des requêtes simples :

```php
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
//a faire dans les controllers
//select:
$resultat = DB::select('select * from table where id = ?', [1]);

//insert:
DB::insert('insert into table (nom, age) values (?,?)', ['nom', 12] );

//update:
DB::update('update table set nom = ? where id = ');

//delete:
DB::delete('delete from table ');

//declaration generale:
DB::statement('drop table table');
```

Il y a possibilité d'utiliser d'autres liaisons que __?__ : les liaisons nommées:

```php
$results = DB::select('select * from users where id = :id', ['id' => 1]);
```

### 		Requêtes avec les Query Builders :

```php
//select

//pour tout recuperer:
DB::table('nom_de_la_table')->get();

//avec condition:
DB::table('table')->where('nom', 'John') //->first() si on veut seulement la premiere ou la condition est validée
    
//un element en particulier:
$age=DB::table('table')->Where('nom', 'John')->value('age');

//trouver une ligne avec l'id:
$personne = DB::table('table')->find($id);

//recuperer toutes les valeurs d'une column:
$noms = DB::table('table')->pluck('nom');
```







