<?php

declare(strict_types=1);

namespace Slotegrator\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220912043702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE settings');
        $this->addSql('ALTER TABLE gifts ADD balance INT NOT NULL');
        $this->addSql('ALTER TABLE money_transactions ADD is_withdrawal_processed TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE settings (id INT AUTO_INCREMENT NOT NULL, `key` VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, valueInt INT DEFAULT NULL, valueRangeIntMin INT DEFAULT NULL, valueRangeIntMax INT DEFAULT NULL, valueString VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE money_transactions DROP is_withdrawal_processed');
        $this->addSql('ALTER TABLE gifts DROP balance');
    }
}
