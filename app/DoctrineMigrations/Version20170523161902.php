<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170523161902 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE place ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE comment CHANGE comment comment LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE country ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE letter CHANGE letter letter LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE route ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE trip ADD description LONGTEXT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment CHANGE comment comment VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE country DROP description');
        $this->addSql('ALTER TABLE letter CHANGE letter letter VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE place DROP description');
        $this->addSql('ALTER TABLE route DROP description');
        $this->addSql('ALTER TABLE trip DROP description');
    }
}
