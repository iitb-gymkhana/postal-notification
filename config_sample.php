<?php

$sso_secret = '';
$smtp_user = '';
$smtp_pass = '';

class Hostel {
    public function __construct($code, $name, $hallmgr) {
        $this->code = $code;
        $this->name = $name;
        $this->hallmgr = $hallmgr;
    }
}

$hostels = array(
	new Hostel("1", "Hostel 1 - Queen of the Campus", "h1hallmgr"),
	new Hostel("2", "Hostel 2 - The Wild Ones", "h2hallmgr"),
	new Hostel("3", "Hostel 3 - Virtuvians", "h3hallmgr"),
	new Hostel("4", "Hostel 4 - Madhouse", "h4hallmgr"),
	new Hostel("5", "Hostel 5 - Penthouse", "h5hallmgr"),
	new Hostel("6", "Hostel 6 - Vikings", "h6hallmgr"),
	new Hostel("7", "Hostel 7 - Lady of the Lake", "h7hallmgr"),
	new Hostel("8", "Hostel 8 - Woodland", "h8hallmgr"),
	new Hostel("9", "Hostel 9 - Pluto", "h9hallmgr"),
	new Hostel("10", "Hostel 10 - Phoenix", "h10hallmgr"),
	new Hostel("11", "Hostel 11 - Athena", "h11hallmgr"),
	new Hostel("12", "Hostel 12 - Crown of the Campus", "h12hallmgr"),
	new Hostel("13", "Hostel 13 - House of Titans", "h13hallmgr"),
	new Hostel("14", "Hostel 14 - Siliconship", "h14hallmgr"),
	new Hostel("15", "Hostel 15 - Trident", "h15hallmgr"),
	new Hostel("16", "Hostel 16 - Olympus", "h16hallmgr"),
	new Hostel("18", "Hostel 18", "h18hallmgr"),
	new Hostel("tansa", "Tansa House", "tansahallmgr"),
	new Hostel("qip", "QIP", "h10ahallmgr"),
);

?>
