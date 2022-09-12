<?php

declare(strict_types=1);

namespace Slotegrator\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220912094616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bonus_transactions ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE gift_transactions ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE gifts ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE money_transactions ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE raffles ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE requisites ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE users ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP createdAt, DROP updatedAt');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gifts ADD createdAt DATETIME NOT NULL, ADD updatedAt DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE requisites ADD createdAt DATETIME NOT NULL, ADD updatedAt DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE raffles ADD createdAt DATETIME NOT NULL, ADD updatedAt DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE money_transactions ADD createdAt DATETIME NOT NULL, ADD updatedAt DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE users ADD createdAt DATETIME NOT NULL, ADD updatedAt DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE gift_transactions ADD createdAt DATETIME NOT NULL, ADD updatedAt DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE bonus_transactions ADD createdAt DATETIME NOT NULL, ADD updatedAt DATETIME NOT NULL, DROP created_at, DROP updated_at');
    }
}
