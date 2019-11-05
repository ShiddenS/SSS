REPLACE INTO ?:statuses (status, type, is_default) VALUES ('P', 'G', 'Y');
REPLACE INTO ?:statuses (status, type, is_default) VALUES ('A', 'G', 'Y');
REPLACE INTO ?:statuses (status, type, is_default) VALUES ('C', 'G', 'Y');
REPLACE INTO ?:statuses (status, type, is_default) VALUES ('U', 'G', 'Y');

REPLACE INTO ?:status_data (status_id, param, value)
SELECT
    status_id,
    'notify' as param,
    'N' as value
FROM ?:statuses
WHERE status = 'P' AND type = 'G';

REPLACE INTO ?:status_data (status_id, param, value)
SELECT
    status_id,
    'notify' as param,
    'Y' as value
FROM ?:statuses
WHERE status = 'A' AND type = 'G';

REPLACE INTO ?:status_data (status_id, param, value)
SELECT
    status_id,
    'notify' as param,
    'Y' as value
FROM ?:statuses
WHERE status = 'C' AND type = 'G';

REPLACE INTO ?:status_data (status_id, param, value)
SELECT
    status_id,
    'notify' as param,
    'N' as value
FROM ?:statuses
WHERE status = 'U' AND type = 'G';