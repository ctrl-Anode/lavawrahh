-- Add status column to class_bookings table
ALTER TABLE `class_bookings` 
ADD COLUMN `status` VARCHAR(20) NOT NULL DEFAULT 'pending' 
AFTER `terms_accepted`;
