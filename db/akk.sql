SELECT id_pegawai, nilai_dp3, AVG(real_capaian) total_capaian, fnilaikinerja(nilai_dp3, AVG(real_capaian)) nilai_kinerja FROM
(SELECT
  `skpt`.`id_pegawai`,
  CAST(IF(dp3.perilaku_kepemimpinan IS NOT NULL OR dp3.perilaku_kepemimpinan > 0, ((dp3.perilaku_pelayanan + dp3.perilaku_integritas + dp3.perilaku_komitmen + dp3.perilaku_disiplin + dp3.perilaku_kerjasama + dp3.perilaku_kepemimpinan)/6),((dp3.perilaku_pelayanan + dp3.perilaku_integritas + dp3.perilaku_komitmen + dp3.perilaku_disiplin + dp3.perilaku_kerjasama)/5)) AS DECIMAL(10,2)) nilai_dp3,
  -- `tsn`.`real_output`,
  fnilaicapaian(AVG(tsn.real_nilai_biaya), fhitung(AVG(tsn.real_nilai_kualitas), skpt.skpt_kualitas, AVG(tsn.real_nilai_kuantitas), skpt.skpt_kuantitas, AVG(tsn.real_nilai_waktu), skpt.skpt_waktu, AVG(tsn.real_nilai_biaya), skpt.skpt_biaya)) real_capaian
FROM
  `tr_skp_tahunan` `skpt`
  LEFT JOIN `tr_skp_nilai` `tsn`
    ON `skpt`.`id_skpt` = `tsn`.`id_skpt`
    AND `tsn`.`current_active` = '1'
  LEFT JOIN `master_pegawai` `p`
    ON `p`.`id_pegawai` = `skpt`.`id_pegawai`
    LEFT JOIN tr_perilaku dp3
    ON dp3.`id_pegawai` = skpt.`id_pegawai` AND dp3.perilaku_tahun = '2019'
WHERE 
 -- `skpt`.`id_pegawai` = '1' AND 
 `skpt`.`skpt_tahun` = '2019' AND 
 `skpt`.`skpt_status` IN (2, 3)
GROUP BY `skpt`.`id_skpt`,
  `p`.`id_pegawai`,
  dp3.perilaku_pelayanan,
  dp3.perilaku_integritas,
  dp3.perilaku_komitmen,
  dp3.perilaku_disiplin,
  dp3.perilaku_kerjasama,
  dp3.perilaku_kepemimpinan
  ) AS htcapaian
  GROUP BY id_pegawai, nilai_dp3
  