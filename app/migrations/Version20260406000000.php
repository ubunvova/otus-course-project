<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260406000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create "users" table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE users (
                id UUID NOT NULL,
                name VARCHAR(255) NOT NULL,
                api_key VARCHAR(64) NOT NULL UNIQUE,
                created_at TIMESTAMP NOT NULL DEFAULT NOW(),
                PRIMARY KEY(id)
            );
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users;');
    }
}
