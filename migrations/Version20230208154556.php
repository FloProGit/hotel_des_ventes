<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208154556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP roles');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE user DROP name, DROP first_name, DROP genre, DROP birthday, DROP phone_number');
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD name VARCHAR(30) NOT NULL, ADD first_name VARCHAR(30) NOT NULL, ADD genre VARCHAR(30) NOT NULL, ADD birthday DATETIME NOT NULL, ADD phone_number VARCHAR(15) NOT NULL, CHANGE roles roles VARCHAR(30) NOT NULL');
    }
}
