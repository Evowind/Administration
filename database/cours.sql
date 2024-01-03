/*!40101 SET FOREIGN_KEY_CHECKS=0 */;


DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`
(
    `id`
    integer
    NOT
    NULL /*!40101 AUTO_INCREMENT */,
    `nom`
    varchar
(
    40
),
    `prenom` varchar
(
    40
),
    `login` varchar
(
    30
) NOT NULL UNIQUE,
    `mdp` varchar
(
    60
) NOT NULL,
    `type` varchar
(
    12
) ,
    check
(
    `type`
    in
(
    NULL,
    'enseignant',
    'gestionnaire',
    'admin'
)),
    PRIMARY KEY
(
    `id`
)
    ) /*!40101 AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 */;

INSERT INTO `users` (`id`, `nom`, `prenom`, `login`, `mdp`, `type`)
VALUES ('1', 'Admin', 'User', 'admin', '$2y$10$OgGilVcpTrARPRsrx8YZf.GRCGW3EAugei7htlwYaGDdbROVRY2pu', 'admin');


DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours`
(
    `id`
    integer
    NOT
    NULL /*!40101 AUTO_INCREMENT */,
    `intitule`
    varchar
(
    50
) NOT NULL,
    `created_at` datetime,
    `updated_at` datetime,
    PRIMARY KEY
(
    `id`
)
    ) /*!40101 AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 */;

DROP TABLE IF EXISTS `cours_users`;
CREATE TABLE IF NOT EXISTS `cours_users`
(
    `cours_id`
    integer
    NOT
    NULL,
    `user_id`
    integer
    NOT
    NULL,
    FOREIGN
    KEY
(
    `cours_id`
) REFERENCES `cours`
(
    `id`
),
    FOREIGN KEY
(
    `user_id`
) REFERENCES `users`
(
    `id`
),
    PRIMARY KEY
(
    `cours_id`,
    `user_id`
)
    ) /*!40101 DEFAULT CHARSET=utf8mb4 */;

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants`
(
    `id`
    integer
    NOT
    NULL /*!40101 AUTO_INCREMENT */,
    `nom`
    varchar
(
    40
) NOT NULL,
    `prenom` varchar
(
    40
) NOT NULL,
    `noet` varchar
(
    15
) NOT NULL,
    `created_at` datetime,
    `updated_at` datetime,
    PRIMARY KEY
(
    `id`
)
    ) /*!40101 AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 */;

-- noinspection SqlDialectInspection,SqlNoDataSourceInspection
DROP TABLE IF EXISTS `cours_etudiants`;
CREATE TABLE IF NOT EXISTS `cours_etudiants`
(
    `cours_id`
    integer
    NOT
    NULL,
    `etudiant_id`
    integer
    NOT
    NULL,
    FOREIGN
    KEY
(
    `cours_id`
) REFERENCES `cours`
(
    `id`
),
    FOREIGN KEY
(
    `etudiant_id`
) REFERENCES `etudiants`
(
    `id`
),
    PRIMARY KEY
(
    `cours_id`,
    `etudiant_id`
)
    ) /*!40101 DEFAULT CHARSET=utf8mb4 */;


DROP TABLE IF EXISTS `seances`;
CREATE TABLE IF NOT EXISTS `seances`
(
    `id`
    integer
    NOT
    NULL /*!40101 AUTO_INCREMENT */,
    `cours_id`
    integer
    NOT
    NULL,
    `date_debut`
    datetime,
    `date_fin`
    datetime,
    FOREIGN
    KEY
(
    `cours_id`
) REFERENCES `cours`
(
    `id`
),
    PRIMARY KEY
(
    `id`
)
    ) /*!40101 AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 */;

DROP TABLE IF EXISTS `presences`;
CREATE TABLE IF NOT EXISTS `presences`
(
    `etudiant_id`
    integer
    NOT
    NULL,
    `seance_id`
    integer
    NOT
    NULL,
    FOREIGN
    KEY
(
    `seance_id`
) REFERENCES `seances`
(
    `id`
),
    FOREIGN KEY
(
    `etudiant_id`
) REFERENCES `etudiants`
(
    `id`
),
    PRIMARY KEY
(
    `etudiant_id`,
    `seance_id`
)
    ) /*!40101 DEFAULT CHARSET=utf8mb4 */;

/*!40101 SET FOREIGN_KEY_CHECKS=1 */;
