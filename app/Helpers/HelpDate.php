<?php
	function CountDay($awal,$akhir){
		$tglAwal = strtotime($awal);
		$tglAkhir = strtotime($akhir);
		$jeda = abs($tglAkhir - $tglAwal);
		return floor($jeda/(60*60*24));
	}
