<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected int $id;

    #[ORM\Column(type: "string", unique: true, nullable: false)]
    protected string $email;

    #[ORM\Column(type: "string", nullable: false)]
    protected string $password;

    #[ORM\Column(type: "string", nullable: true)]
    protected ?string $firstName;

    #[ORM\Column(type: "string", nullable: true)]
    protected ?string $lastName;

    #[ORM\Column(type: "string", nullable: true)]
    protected ?string $mobilePhone;

    #[ORM\Column(type: "string", nullable: true)]
    protected ?string $country;

    #[ORM\Column(type: "string", nullable: true)]
    protected ?string $city;

    #[ORM\Column(type: "string", nullable: true)]
    protected ?string $address;

    #[ORM\Column(type: "string", nullable: true)]
    protected ?string $role = 'user';

    public function getArrayCopy(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'mobilePhone' => $this->mobilePhone,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'email' => $this->email,
        ];
    }

    public function exchangeArray(array $data): void
    {
        $this->firstName = $data['firstName'] ?? null;
        $this->lastName = $data['lastName'] ?? null;
        $this->mobilePhone = $data['mobilePhone'] ?? null;
        $this->country = $data['country'] ?? null;
        $this->city = $data['city'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->email = $data['email'] ?? null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email ?? '';
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password ?? '';
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName ?? '';
    }

    /**
     * @param string|null $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName ?? '';
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string|null
     */
    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone ?? '';
    }

    /**
     * @param string|null $mobilePhone
     */
    public function setMobilePhone(?string $mobilePhone): void
    {
        $this->mobilePhone = $mobilePhone;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country ?? '';
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city ?? '';
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address ?? '';
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role ?? '';
    }

    /**
     * @param string|null $role
     */
    public function setRole(?string $role): void
    {
        $this->role = $role;
    }


}
