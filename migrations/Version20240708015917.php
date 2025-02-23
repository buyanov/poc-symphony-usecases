<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240708015917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create shop table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE shop_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE shop (id INT NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE shop_id_seq CASCADE');
        $this->addSql('DROP TABLE shop');
    }
}
