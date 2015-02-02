<?php

class OperatingSystem {

	static $icons = array(
			"Windows 8" => "os_win8",
			"Windows 8.1" => "os_win8",
			"Windows" => "os",
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
			"LXLE" => "dist_lxle",
			"Fedora" => "dist_fedora",
			"Mageia" => "dist_mageia",
			"Crunchbang" => "dist_crunchbang",
			"Linux" => "os_linux",
			"OpenBSD" => "os_openbsd",
			"FreeBSD" => "os_freebsd",
			"Solaris" => "os_solaris",
			"Android" => "os_android",
			"Other" => "os_other",
	
	);
	
	public static function getIcon($os) {
		foreach (self::$icons as $name => $icon) {
 			if (strpos(strtolower($os), strtolower($name)) === 0) {
 				return "images/icons/" . $icon . ".png";
 			}
		}
		
		return "images/icons/os_other.png";
	}
}