<?php

class OperatingSystem {

	static $icons = array(
			"Windows 10" => "os_win8",
			"Windows 8" => "os_win8",
			"Windows 8.1" => "os_win8",
			"Windows 2000" => "os_win2000",
			"Windows XP" => "os_winxp",
			"Windows" => "os_win",
			"Mac OS X" => "os_mac",
			"Ubuntu" => "dist_ubuntu",
			"Kali" => "dist_kali",
			"CentOS" => "dist_centos",
			"Debian" => "dist_debian",
			"elementary OS" => "dist_elementaryos",
			"Mint" => "dist_mint",
			"Slackware" => "dist_slackware",
			"Arch" => "dist_arch",
			"Gentoo" => "dist_gentoo",
			"Raspbian" => "dist_raspbian",
			"SteamOS" => "dist_steam",
			"Fedora" => "dist_fedora",
			"Mageia" => "dist_mageia",
			"Alpine" => "dist_alpine",
			"Crunchbang" => "dist_crunchbang",
			"Antergos" => "dist_antergos",
			"Chakra" => "dist_chakra",
			"Evolve OS" => "dist_evolveos",
			"KaOS" => "dist_kaos",
			"Frugalware" => "dist_frugalware",
			"Funtoo" => "dist_funtoo",
			"Jiyuu" => "dist_jiyuu",
			"Deepin" => "dist_deepin",
			"Korora" => "dist_korora",
			"Mandriva" => "dist_mandriva",
			"Mandrake" => "dist_mandrake",
			"Manjaro" => "dist_manjaro",
			"LMDE" => "dist_lmde",
			"OpenSUSE" => "dist_opensuse",
			"Parabola" => "dist_parabola",
			"Peppermint" => "dist_peppermint",
			"RedHat Enterprise" => "dist_redhatenterprise",
			"Sabayon" => "dist_sabayon",
			"Scientific Linux" => "dist_scientificlinux",
			"SolusOS" => "dist_solusos",
			"TinyCore" => "dist_tinycore",
			"Trisquel" => "dist_trisquel",
			"Viperr" => "dist_viperr",			
			"Linux" => "os_linux",
			"OpenBSD" => "bsd_openbsd",
			"FreeBSD" => "bsd_freebsd",
			"NetBSD" => "bsd_netbsd",
			"DragonFlyBSD" => "bsd_dragonflybsd",
			"Solaris" => "os_solaris",
			"Android" => "os_android",
			"Other" => "os_unknown",
			"Unknown" => "os_unknown",	
	);
	
	public static function getIcon($os) {
		foreach (self::$icons as $name => $icon) {
 			if (strpos(strtolower($os), strtolower($name)) === 0) {
 				$file = "images/icons/" . $icon . ".png";
 				if (!file_exists($file)) {
 					continue;
 				}
 				return $file;
 			}
		}
		
		return "images/icons/os_unknown.png";
	}
}