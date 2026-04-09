<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260408000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create "image_processing" table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
                CREATE TABLE image_processing (
                    id UUID PRIMARY KEY,
                    user_id UUID NOT NULL,
                    file_path VARCHAR(255) NOT NULL,
                    operations JSONB NOT NULL,
                    status VARCHAR(32) NOT NULL,
                    result_file_path VARCHAR(255),
                    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
                    updated_at TIMESTAMP NOT NULL DEFAULT NOW(),
                    FOREIGN KEY (user_id) REFERENCES users(id)
                );
            SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE image_processing;');
    }
}
