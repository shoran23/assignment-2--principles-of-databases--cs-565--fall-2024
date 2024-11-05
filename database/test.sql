SELECT
    model,
    devices.darwin,
    models.darwin
FROM
    models
CROSS JOIN
    devices
    USING(model_id)
CROSS JOIN
    operating_systems
    USING(models.darwin);