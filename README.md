chessRRPairing
==============

system to pair Round Robin (league) system for chess tournaments [unfinished]

The system needs a database to work as it saves players and pairings to a database.
It is currently configured to be used with a MySQL database, having the database configuration on the db/db_config.php file.
With a MySQL server running, on the index page, hitting the submit button for "Perform database actions" creates the database
and all necessary tables.

The user access is hardcoded not to be needed. To create a tournament go to the "CREAR TORNEO" menu tab.
You will need to specify a name and a number of players. Later, it will ask you for the players' names.

The "ver torneos" tab allows to view the tournaments. Once a tournament is chosen it is possible to add the game results for it.
At the right side a standings table is shown.

It is also possible to get a printable version of the pairings.
