-- 增：
insert `emostore`(`name`,`iconurl`,`postedon`,`introduction`,`creator`,`creatorurl`,`server`,`serverurl`,`dataformat`,`installurl`,`codeurl`) values('nametest','iconurltest','2014-07-30','posttest','createst','xreaurltest','servertest','serurltest','dformatest','insturltest','codetest');
-- 删：
delete from `emostore` where `id`=3;
-- 改（部分）：
update `emostore` set `name`='nametest0' where `id`=3;
-- 改（全部）：
update `emostore` set `name`='nametest0',`iconurl`='iconurltest0',`postedon`='2014-07-29',`introduction`='posttest0',`creator`='createst0',`creatorurl`='xreaurltest0',`server`='servertest0',`serverurl`='serurltest0',`dataformat`='dformatest0',`installurl`='insturltest0',`codeurl`='codetest0' where `id`=3;
-- 查（部分）：
select * from `emoticonstore`.`emostore` limit 0,2;
-- 查（全部）：
select * from `emoticonstore`.`emostore`;
-- 数据量：
select count(*) from `emoticonstore`.`emostore`;