
--mst_ocean_ports
alter table db_seida.mst_ocean_ports add column tipo_puerto_adicional varchar(10);

--oi_bill_of_ladings

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
