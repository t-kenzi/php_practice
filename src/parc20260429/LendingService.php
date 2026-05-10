<?php
include "php_base/src/parc20260429/LibraryCatalog.php";
include "php_base/src/parc20260429/Member.php";

class LendingService
{
    private LibraryCatalog $libraryCatalog;
    private array $memberLists;

    public function __construct(LibraryCatalog $libraryCatalog)
    {
        $this->libraryCatalog = $libraryCatalog;
        $this->memberLists = [];
    }

    public function registerMember(int $id, string $name): void
    {
        $newMember = new Member($id, $name);
        $this->memberLists[] = $newMember;
    }

    public function checkMember(int $memberId): bool
    {
        foreach ($this->memberLists as $member) {
            if ($member->getMemberId() === $memberId) {
                return true;
            }
        }

        return false;
    }

    public function searchMember(int $memberId)
    {
        foreach ($this->memberLists as $member) {
            if ($member->getMemberId() === $memberId) {
                return $member;
            }
        }

        return null;
    }

    public function borrowBook(int $memberId, int $bookId): bool
    {
        $member = $this->searchMember($memberId);
        $book = $this->libraryCatalog->searchBook($bookId);

        if ($member === null || $book === null) {
            return false;
        }

        if ($book->getLendStatus() === true) {
            return false;
        }

        $book->lendBook();
        $member->addBorrowBook($bookId);

        return true;
    }

    public function returnBook(int $memberId, int $bookId): bool
    {
        $member = $this->searchMember($memberId);
        $book = $this->libraryCatalog->searchBook($bookId);

        if ($member === null || $book === null) {
            return false;
        }

        if ($member->searchBookLists($bookId) === false) {
            return false;
        }

        $book->returnBook();
        $member->removeBorrowBook($bookId);

        return true;
    }
}
