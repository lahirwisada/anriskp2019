SELECT
IF(JSON_SEARCH(nilai_tugas_tambahan, 'all',12) IS NULL, NULL, 
JSON_EXTRACT(nilai_tugas_tambahan, JSON_UNQUOTE(REPLACE(JSON_SEARCH(nilai_tugas_tambahan, 'all',12), 'id', 'status_nilai')))
)
 FROM tr_skp_tahunan
WHERE id_skpt = 14;

-- {"array": [{"id": "203", "status_nilai": "0"}], "status_summary": "0"}

SELECT
*
 FROM tr_skp_tahunan
WHERE nilai_tugas_tambahan->>'$.status_summary' >1 OR nilai_tugas_tambahan IS NULL;