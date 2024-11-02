-- this will work but need to include something that will help put it in the correct order.

DROP VIEW IF EXISTS DeviceReleaseNames;
CREATE VIEW DeviceReleaseNames
    AS
SELECT
    model,
    release_name as device_release
FROM
    operating_systems
CROSS JOIN
    devices
    USING(darwin)
CROSS JOIN
    models
    USING(model_id);


DROP VIEW IF EXISTS ModelsLastSupportReleaseNames;
CREATE VIEW ModelsLastSupportReleaseNames
    AS
SELECT
    model,
    release_name as model_release
FROM
    operating_systems
CROSS JOIN
    models
    USING(darwin);

SELECT
    model,
    device_release,
    model_release
FROM
    DeviceReleaseNames
CROSS JOIN
    ModelsLastSupportReleaseNames
    USING(model);


