
--mst_ocean_ports
alter table db_seida.mst_ocean_ports add column tipo_puerto_adicional varchar(10);

--oi_bill_of_ladings

update db_seida.oi_bill_of_ladings set 
proposito_documento_adicional        = 'TX0101 Numeracion del Manifiesto de Carga',
codigo_empresa_software_adicional    = '1234',
numero_referencial_adicional         = '2013180301',
aduana_proceso_adicional             = '046',
referencia_emisor_adicional          = '2013180301',
tipo_operador_adicional              = '12',
codigo_etapa_transporte_adicional    = '20',
documento_unico_escala_adicional     = 'PAI-2013-180136',
nombre_responsable_adicional         = 'VIKTOR PROKHOROV',
ruc_operador_portuario_adicional     = '20504192157',
tipo_lugar_descarga_adicional        = '164',
tipo_lugar_llegada_adicional         = '60',
tipo_medio_transporte                = '1501',
matricula_nave_adicional             = '99477828',
codigo_tipo_manifiesto_adicional     = '01',
codigo_aduana_adicional              = '046',
tipo_documento_transporte_adicional  = '704',
pais_origen_adicional                = 'LV',
destinacion_carga_adicional          = '23',
codigo_contrato_adicional            = '10',
codigo_servicio_adicional            = '11',
tipo_flete_adicional                 = '100',
tipo_pago_adicional                  = 'PP'
where id in (20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130
);




update db_seida.oi_bill_of_lading_container_details set
tara_contenedor_adicional    	 = 1000,
tipo_equipamiento_adicional      = '23',
sub_tipo_equipamiento_adicional  = '45GP',
tipo_llenado_adicional           = '8',
tipo_movimiento_adicional        = '3',
condicion_precinto_adicional     = '1',
entidad_precinto_adicional    	 = 'AB',
tipo_temperature_adicional   	 = '2'
where id in ('fdeb0910-3e15-11ea-80f6-c1fe65730e6a','fb60f230-8cf4-11ea-8a0d-6955ad379ea9','F3A52F00-6D2A-11E9-BF8E-B3E53EBE24F8','F3A08CC0-6D2A-11E9-87B1-5D87EE16B89A','F39D1580-6D2A-11E9-A77B-B78BF6E7A0D8','F3988AA0-6D2A-11E9-9554-ADCE5F6DE48B','F3903140-6D2A-11E9-8EBE-473097C25446','f2ab5bd0-8cf5-11ea-8f70-853e758cb6e3','ee8331e0-bf1a-11ea-b8d9-e794e729003c','e99f0e60-3723-11ea-94e2-69c1711e9591','e86dc2a0-6e29-11ea-b69c-f505b136c2a1','e678ad40-7085-11ea-a744-57414e627a32','e2a98d50-7088-11ea-939f-4b486059f889','e277c430-8cf7-11ea-9125-3f8a2f239fbc','db7871c0-9a16-11ea-83ae-5362085dcec9','d9da7290-3df1-11ea-bae5-c111701ddf90','d96c49e0-3df2-11ea-8171-99eeea8df121','d79a2240-3228-11ea-a044-bb22a612415b','D7162750-8CFC-11EA-A392-A59B208165A1','D71152B0-8CFC-11EA-B86C-491C433DE158','D70D5C40-8CFC-11EA-A46E-7FC9B818E9D7','D68179D0-2B29-11EA-A455-BB1E4089D3E5','d6690060-bf21-11ea-90ad-b16be872b57c','d5787520-7da0-11ea-ad31-1d4e63e5dad3','d5743d00-6e2a-11ea-ab15-85271c6abc21','d49306c0-3038-11eb-b241-511e9cbd3137','cc00da90-503b-11ea-a841-138c95ef2862','c9dd91a0-bf24-11ea-861e-af44536faf45','c99f1b40-3b2b-11eb-b0f9-d7d9bcb1ed51','c89732a0-38a6-11ea-9009-533f7e6684f3','c6bd8e80-7086-11ea-b2bb-b5982aca60c8','c3968380-bf25-11ea-8a09-5949b1247a51','c32c8740-7e62-11ea-98f0-bf222a184961','c1612de0-b659-11ea-93d3-2dddf3623377','c011a560-7069-11ea-bb39-ebc6098ab8e7','bfc628f0-7087-11ea-9596-0169e537a130','bad63070-318e-11ea-be10-cf6218a2e7e1','b950ab10-501f-11e9-ab06-df39d3b8a11e','b307f820-3108-11eb-b8e3-1b0dc87b0c78','b273e920-93d0-11ea-a06e-8f3181379de1','b0e75490-569e-11ea-a0ca-952bbf97c7c7','b0979980-93c9-11ea-a932-c7f225354c91','afc41b30-779a-11ea-8449-752f33852901','ac0ecd50-3b28-11eb-bc89-f9e091454699','aa507830-8cfa-11ea-a04f-c1c6e57ef815','a903fa80-742d-11ea-b555-4b5ddd7e7c5a','a3827c70-8cf6-11ea-ab30-9d949cb6bef8','a0f663a0-8cf8-11ea-9b0a-8b7f77159611','9f6098f0-3df2-11ea-90b2-f34aceea457b','9edb5690-4cd9-11ea-b56d-0dbcdb4f06a8','9dc60b20-7e70-11ea-8ad2-1512a953890b','9cfeec00-8cfc-11ea-a5af-533872be6b96','9ce8f7a0-4dce-11ea-9012-f35c47235fba','9c970620-b70c-11ea-a8a1-41c44ca5f85d','97786330-bf18-11ea-a1fc-b7cbd90f7a50','969e84f0-7068-11ea-be5d-d915c06eae6e','946bc310-6d46-11ea-aefb-494de528f2ee','9234f260-706f-11ea-bc97-b14665750813','91e59f30-6d56-11ea-bd6c-613467224e23','91006510-7793-11ea-8807-e7b161f0f497','8a063d30-9ad6-11ea-9913-b39260334004','8707b930-8cfd-11ea-9a5b-fd7f333d8bf3','85aedee0-3df1-11ea-b637-e37c0f04c59b','8590f150-3184-11ea-884e-536d2fb6a4ac','83b07b20-8cfc-11ea-a406-ab7e830428ba','82799bc0-4767-11ea-930e-89bce674fa28','7ebde1f0-5d8f-11ea-b102-997cfa471b9d','7e77b770-51bb-11ea-afd1-5be0ff92b7b0','7deb69a0-3df3-11ea-b022-ff2673b16dbc','75d327e0-779c-11ea-ba69-f7bda33fafe7','71f38380-7798-11ea-bab8-f1d50ccfd0c9','6ddc9460-7087-11ea-8696-09f8d9f1bd12','6dd775a0-7088-11ea-a090-29a6957cd634','6ca7bb20-8cf9-11ea-8c70-e94e9c50e131','6a2f25f0-9c74-11ea-97f8-456728ff4cd4','635635f0-3df2-11ea-b30b-f9a9859f2dee','5cc6b8c0-7797-11ea-91ad-21112e144597','58966c90-3df5-11ea-80a3-0d2a07bd473b','55fdd760-6eec-11ea-a7c0-8b3bb43fc1e3','54227c90-38a7-11ea-9a16-df27de24653e','518961d0-c22c-11ea-8517-d16eebb9c1db','500f8d30-6e28-11ea-8263-737fc4b91589','4f93d800-706d-11ea-83ba-ff755c1a8040','4f7ec660-706b-11ea-9f80-65f90fec8080','4e792170-b65a-11ea-b6b5-3561ee7ecd87','4648b060-b657-11ea-9e57-83539d7bd713','45697620-779b-11ea-9a41-31c95cc98e2a','446eb330-3039-11eb-b767-c7cc99251deb','43423dd0-7089-11ea-96f4-df09f9989ae7','42c4aa70-79cc-11ea-b22c-71588086216b','406ad620-7088-11ea-b2c0-396a75b8358d','40507c20-8cf7-11ea-b951-9b6f498f1dc8','403e9470-3df3-11ea-a2f3-bfa138721239','3a505590-331c-11ea-9e26-d97912af3eb1','3788a8b0-5022-11ea-aa86-39362cdd5a3f','36d31df0-b658-11ea-beb3-df492702f006','34ce4380-7dc8-11ea-8dd1-ff8ea74e8dab','2FBF5260-7445-11EA-B6BE-39B8AEF495A1','297a2b60-b65a-11ea-b28a-3fb7273149b5','2563c360-4f73-11ea-8aa2-9717267f6c50','2449ecf0-7796-11ea-aafb-5bc03c1e3bdf','237db340-779d-11ea-878c-0f0761b05c12','20bf3640-318f-11ea-beba-2b7ea6d5dd1e','1e3186c0-7087-11ea-9102-7b9ff65e3804','1bdaa620-3df2-11ea-9069-13c24033c8e7','19c810f0-706f-11ea-8064-4d3734e3a5d6','187e06e0-7db6-11ea-9fed-63d3cce6214a','154411a0-5672-11ea-84c6-7f223d48b6db','14614eb0-3df3-11ea-b328-89c0732e934a','14493df0-7799-11ea-9da2-bfc2ca4a43b2','13a39110-79e0-11ea-a06f-fb19bf8d4a1d','135b5b30-3185-11ea-9d99-111fade16f9a','12c62f70-8cfe-11ea-adc0-85512e0f45a2','127289e0-7089-11ea-b723-5de414e609b1','11C32510-2B29-11EA-AAFF-536EC0237DB9','10829a40-318b-11ea-8dc0-8184b101cf24','0fc8ea60-7795-11ea-91f3-63050e8aa53c','0e4e4ad0-502b-11ea-9f42-2104db488857','0e22e7d0-38a7-11ea-9c57-399ef844e2c0','0d720630-3877-11ea-862e-0f7c6da126f3','0cdfdd80-93d3-11ea-9156-f52ae783d5e8','08af2f90-8cfa-11ea-89ac-edb852da84a4','089afd50-bf1e-11ea-b8da-a909081e1134','04b27630-4dcc-11ea-9bf0-1712176455ba','03dbdbf0-3330-11ea-94fa-555396cb64df','03d5ed00-51c4-11ea-98ad-4bc9d59d7bf7','0365b430-3185-11ea-bf5d-add6587f3fb6','0198de50-7e86-11ea-9f98-9df9f7f2835f'
); 

update db_seida.oi_bill_of_lading_cargo_details set
condicion_carga_adicional       = '4',
codigo_naturaleza_adicional     = '12',
partida_arancelaria_adicional   = '3104000000',
tipo_de_bultos_adicional        = 'VR',
marcas_numeros_adicional        = 'SM/SN'
where id in ('FC6E0090-30BE-11EA-8ED4-414939A394D1','FC6D9A90-30BE-11EA-894C-97E25FAF34B5','FC6D32A0-30BE-11EA-A3B3-BB140E881684','FC6CC8D0-30BE-11EA-8443-B90C5F3CC7E9','FC6C5600-30BE-11EA-96BE-35CB2D044083','FC6B4C10-30BE-11EA-ABDB-A942B0CEA20F','FC6ADEF0-30BE-11EA-88A4-6DC5A5A83843','FC6A6F20-30BE-11EA-8986-BD47C1CBD50E','FBDB9C70-7DB5-11EA-AB77-899E7FCA4F54','FBA59190-779C-11EA-9709-C939C8B28C56','F8B2C220-4C3E-11EA-90F9-9BD21E87F899','F3A56EB0-6D2A-11E9-AFED-6D79BE43BE7A','F3A0CBC0-6D2A-11E9-AEBC-5F3D7BF9E3E7','F39D5400-6D2A-11E9-B09B-93D571599E07','F398CB50-6D2A-11E9-A3CB-ADBAFF143FC7','F3915170-6D2A-11E9-97BB-7B6BE9BA8B99','F342B7B0-7795-11EA-A105-47F44A646BC6','EEE86010-7E85-11EA-A7E6-CB3D2537E579','EEB332E0-B658-11EA-842C-FB5D5D044837','ECA86190-8CF6-11EA-9C00-C1803AD05C19','EC9A8740-79DF-11EA-B6A6-737E97D61D19','EC41D8E0-7798-11EA-AE8A-C1E4330039B9','DF5154C0-8CFB-11EA-9D05-B3AA1DCF2940','DC3AE540-93D2-11EA-9F30-B1B1DAFCF217','D7B55B20-51BA-11EA-A8F0-3DAF3DF0011A','D7167440-8CFC-11EA-B83A-3B2AF5705716','D71197B0-8CFC-11EA-B073-A9BEF84983B9','D70DA2A0-8CFC-11EA-9934-973A9047EB12','D7096C00-8CFC-11EA-9C06-EB9E97D90B0E','D7048180-8CFC-11EA-9D28-5F8A42923EAA','D681D410-2B29-11EA-9B43-87E419A1BCAA','D60D7600-7E60-11EA-9363-636A8B46A0CC','D2FEE7F0-2DA1-11EA-9CE8-8F1FE09147E8','CD94EEC0-30BE-11EA-9EFD-71F0BAEE6FD1','CD909C50-30BE-11EA-B1C5-498AE402DCBE','CD8C6190-30BE-11EA-8A47-3D668B331553','CD884B70-30BE-11EA-882A-0749AFB17FE2','CD839730-30BE-11EA-B24E-CF821F774E33','CD7F6610-30BE-11EA-AAF5-3D0127C81434','CD7825D0-30BE-11EA-9406-DDD403365A67','CD73F610-30BE-11EA-A61D-096A9894775F','C10203E0-8CF8-11EA-BB91-9B914315BFB8','BEF33200-38A5-11EA-83BE-0DAA83ACDAFB','BEEF5AF0-38A5-11EA-BEAC-474CC44A0F11','BEEB7790-38A5-11EA-B266-7902C8355C11','BEE77930-38A5-11EA-9D88-49EEF6DF9574','BEE34BB0-38A5-11EA-ABC1-273A9DF276CB','BEDEB8F0-38A5-11EA-8974-4BFC98EBEC52','BEDAA1B0-38A5-11EA-BDA7-CB2441C69621','BED69430-38A5-11EA-B79E-89AFC8D256D6','BED1BEF0-38A5-11EA-B9B1-3F7AAFFB7D05','BECD5190-38A5-11EA-BAD3-6529FD44077F','BEC91820-38A5-11EA-94C6-2503D43610F1','BEC3F220-38A5-11EA-B2C4-6347956BE196','BC090800-B657-11EA-B438-F14CF02CA2AD','B917D900-331A-11EA-8FD0-458D1511AEEC','B8BECF80-3874-11EA-89D1-3B62D28F272B','B288A520-79D0-11EA-93A8-91F35DCA5857','AE7BD010-7DA0-11EA-9737-470A4D505A8B','A9E9A540-706E-11EA-8599-4FCF5E380F0B','A9E582C0-706E-11EA-A7E5-65DF9BFDC5F7','A9E13900-706E-11EA-9A83-479AAA8918A0','A9DCF480-706E-11EA-9326-1F70995FB6D7','A9D8D040-706E-11EA-9493-17953039EA7C','A9D48700-706E-11EA-9B5C-53C5BC8AC03F','A9D04C30-706E-11EA-80DA-498C059A1B04','A9CBD760-706E-11EA-92E4-C158599C98B6','A9C76290-706E-11EA-A4FC-BF19B2954DE7','A9C2BAC0-706E-11EA-86F6-0933E3050565','A9BDBE10-706E-11EA-81B7-0F3B5A7FD768','A9B89610-706E-11EA-88CF-95F8E4E9BFAC','A6B93920-4F71-11EA-8EBB-25341D57E514','a642b1c0-4e99-41a5-8831-6f513596bf18','A4325B10-4DCB-11EA-845A-7FFB813FAD7A','A18481C0-BF1A-11EA-8CA9-1BC0DEE66E2D','9D672080-B656-11EA-8BA1-45496ECF2484','9B31F610-502A-11EA-AC81-892AA625A78C','9A7FD540-8CF9-11EA-BB06-85C7ED7CC23B','997E5D00-3DF4-11EA-B5FD-4725DA60F4DB','97F973C0-4C50-11EA-AD80-6FFCC82A124C','94D5A950-779A-11EA-8A92-BDD1172AFA90','92B58D90-6E2A-11EA-946A-D3F61347A9BC','91B200F0-3038-11EB-B716-1B135EE3F4BD','911AC030-51C2-11EA-99D4-F5DC19E33BBA','8B67BFE0-7794-11EA-AC8D-BB10A7833E84','8A324D30-3108-11EB-AA7C-7D033A0246A4','85620780-9A16-11EA-8BA5-637FA80C4D97','811DFF40-BF21-11EA-B89B-F1817A7E532E','7ED18630-569E-11EA-8802-6B1569B11629','7BF4C900-3B28-11EB-9290-CD0C136922B4','7BE0D400-3B2B-11EB-B0B6-5DD1C0AFEFD3','772BD680-B70C-11EA-9CEC-39321D6F1A38','720313B0-8CF7-11EA-91BE-979862991875','6DA0ED30-5021-11EA-A615-097B7F23AC63','6D2E6290-93C9-11EA-B735-9FB82EF374A7','6B7ABBE0-7067-11EA-A9A7-C1D0AA47C824','65B54B50-7069-11EA-946F-5D1265FC39A8','6561EF20-9AD6-11EA-89AC-B9F1FCAE426C','62A23ED0-8CF5-11EA-9CB4-E33E17B0E320','61A69980-BF1D-11EA-9E6F-E9798871BDFD','5FA53E20-7E70-11EA-9317-51E50E3B0A39','555A49B0-8CF8-11EA-B328-7328DC4A0BE6','549298F0-5670-11EA-AC63-376883A1B758','53BF9BC0-7798-11EA-A5F9-8D4EDF376E23','5247D370-BF18-11EA-9B1E-C9E4E8B4B364','4F4DFE10-742D-11EA-9EE1-3D76F504C433','4C1A81E0-9C74-11EA-85E1-F7F68C040D96','4A277F40-7793-11EA-BB59-CB2AC5C1DE1E','43EC7D80-6D46-11EA-8CD1-3F21F2D34E55','41723AE0-8CFC-11EA-B0BD-6381703CF5D2','3F204DE0-3E15-11EA-AFA0-ABDAA91CA4ED','3E221430-779C-11EA-99A4-C59C1E991F1B','3D920700-BF25-11EA-9869-CB5220DC85C0','3D4A1860-93CE-11EA-A3E8-FF561818C305','3C65A8A0-8CFA-11EA-AACF-9977D3D7AE72','3B9FDB20-B65A-11EA-A711-7BDCE1BBB9C6','39F0F100-8CF6-11EA-98B4-717654B48939','3904A030-7797-11EA-BA01-A97EDE8A25E7','37479AF0-BF24-11EA-A524-D549BB4BB7F6','355010C0-503B-11EA-A6E6-7DE308B9E028','30CBABB0-C22C-11EA-AF11-BBC60730FB24','2FBFADF0-7445-11EA-BA40-D92F1FD2F7B3','27CD7CC0-3621-11EA-930F-A3C16C981AD2','26468F10-4767-11EA-BC17-31A2629C0C4F','25FB9E90-6E28-11EA-8F8C-436E8D31C9CF','25166C80-3039-11EB-8B29-9DD8FE38EA26','23FFC400-779B-11EA-8AA7-19A418262074','1992D660-79CC-11EA-B36E-41BF54572924','185E52F0-706B-11EA-9B57-338E67BC0E88','169807E0-6E29-11EA-BAAE-47E47C506578','126E37D0-B65A-11EA-8CD3-CB1B2D0FBECA','11C38140-2B29-11EA-9966-C1ABE7C2B886','0C245E20-6EEC-11EA-8F27-071F377CF590','0B05DA70-4DCE-11EA-BDAE-C13CBFE15CC8','0A685610-7DC8-11EA-BE10-EB07F831ACEB','05906F60-706D-11EA-B191-ED2992BEE79D','0201B870-6D55-11EA-9389-6D73573F6F70'
); 



alter table db_seida.oi_bill_of_ladings add column proposito_documento_adicional        varchar(100); 
alter table db_seida.oi_bill_of_ladings add column codigo_empresa_software_adicional    varchar(10);
alter table db_seida.oi_bill_of_ladings add column numero_referencial_adicional         varchar(20);
alter table db_seida.oi_bill_of_ladings add column aduana_proceso_adicional             varchar(10);
alter table db_seida.oi_bill_of_ladings add column referencia_emisor_adicional          varchar(10);
alter table db_seida.oi_bill_of_ladings add column tipo_operador_adicional              varchar(10);
alter table db_seida.oi_bill_of_ladings add column codigo_etapa_transporte_adicional    varchar(2);
alter table db_seida.oi_bill_of_ladings add column documento_unico_escala_adicional     varchar(50);
alter table db_seida.oi_bill_of_ladings add column nombre_responsable_adicional         varchar(50);
alter table db_seida.oi_bill_of_ladings add column ruc_operador_portuario_adicional     varchar(20);
alter table db_seida.oi_bill_of_ladings add column tipo_lugar_descarga_adicional        varchar(4);
alter table db_seida.oi_bill_of_ladings add column tipo_lugar_llegada_adicional         varchar(4);
alter table db_seida.oi_bill_of_ladings add column tipo_medio_transporte                varchar(4);
alter table db_seida.oi_bill_of_ladings add column matricula_nave_adicional             varchar(50);
alter table db_seida.oi_bill_of_ladings add column codigo_tipo_manifiesto_adicional     varchar(5);
alter table db_seida.oi_bill_of_ladings add column codigo_aduana_adicional              varchar(5);
alter table db_seida.oi_bill_of_ladings add column tipo_documento_transporte_adicional  varchar(4);
alter table db_seida.oi_bill_of_ladings add column pais_origen_adicional                varchar(3);
alter table db_seida.oi_bill_of_ladings add column destinacion_carga_adicional          varchar(3);
alter table db_seida.oi_bill_of_ladings add column codigo_contrato_adicional            varchar(4);
alter table db_seida.oi_bill_of_ladings add column codigo_servicio_adicional            varchar(4);
alter table db_seida.oi_bill_of_ladings add column tipo_flete_adicional                 varchar(3);
alter table db_seida.oi_bill_of_ladings add column tipo_pago_adicional                  varchar(3);

--oi_bill_of_lading_container_details

alter table db_seida.oi_bill_of_lading_container_details add column  tara_contenedor_adicional    	 decimal(10,3);    
alter table db_seida.oi_bill_of_lading_container_details add column  tipo_equipamiento_adicional     varchar(5);
alter table db_seida.oi_bill_of_lading_container_details add column  sub_tipo_equipamiento_adicional varchar(5);
alter table db_seida.oi_bill_of_lading_container_details add column  tipo_llenado_adicional          varchar(5);
alter table db_seida.oi_bill_of_lading_container_details add column  tipo_movimiento_adicional       varchar(5);	
alter table db_seida.oi_bill_of_lading_container_details add column  condicion_precinto_adicional    varchar(2);	
alter table db_seida.oi_bill_of_lading_container_details add column  entidad_precinto_adicional    	 varchar(3);	
alter table db_seida.oi_bill_of_lading_container_details add column  tipo_temperature_adicional   	 varchar(5);	


--oi_bill_of_lading_cargo_details

alter table db_seida.oi_bill_of_lading_cargo_details add column  condicion_carga_adicional       varchar(1);
alter table db_seida.oi_bill_of_lading_cargo_details add column  codigo_naturaleza_adicional     varchar(2);
alter table db_seida.oi_bill_of_lading_cargo_details add column  partida_arancelaria_adicional   varchar(12);
alter table db_seida.oi_bill_of_lading_cargo_details add column  tipo_de_bultos_adicional        varchar(2);
alter table db_seida.oi_bill_of_lading_cargo_details add column  marcas_numeros_adicional        varchar(20);
