<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200715194515 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hours DROP FOREIGN KEY FK_8A1ABD8D27EE619F');
        $this->addSql('DROP INDEX IDX_8A1ABD8D27EE619F ON hours');
        $this->addSql('ALTER TABLE hours ADD acceptorid INT DEFAULT NULL, DROP acceptorid_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hours ADD acceptorid_id INT DEFAULT NULL, DROP acceptorid, CHANGE timestamp timestamp DATETIME DEFAULT \'current_timestamp()\' NOT NULL, CHANGE overtacceptance overtacceptance INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hours ADD CONSTRAINT FK_8A1ABD8D27EE619F FOREIGN KEY (acceptorid_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8A1ABD8D27EE619F ON hours (acceptorid_id)');
        $this->addSql('ALTER TABLE user CHANGE position position VARCHAR(30) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE managerid managerid INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vacation_request CHANGE comment comment VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
