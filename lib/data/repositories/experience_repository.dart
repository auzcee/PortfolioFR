// lib/data/repositories/experience_repository.dart
// ─────────────────────────────────────────────────────────────────────────────

import 'package:sqflite/sqflite.dart';
import 'package:portfolioph/data/datasources/local/database_service.dart';
import 'package:portfolioph/data/models/experience_model.dart';

class ExperienceRepository {
  final DatabaseService _db;

  ExperienceRepository({DatabaseService? databaseService})
    : _db = databaseService ?? DatabaseService();

  Future<int> insert(ExperienceModel experience) async {
    final db = await _db.getDatabase();
    return db.insert(
      'work_experience',
      experience.toMap(),
      conflictAlgorithm: ConflictAlgorithm.abort,
    );
  }

  Future<List<ExperienceModel>> findByUserId(int userId) async {
    final db = await _db.getDatabase();
    final rows = await db.query(
      'work_experience',
      where: 'user_id = ?',
      whereArgs: [userId],
      orderBy: 'sort_order ASC, start_date DESC',
    );
    return rows.map(ExperienceModel.fromMap).toList();
  }

  Future<int> update(ExperienceModel experience) async {
    final db = await _db.getDatabase();
    return db.update(
      'work_experience',
      experience.toMap(),
      where: 'id = ?',
      whereArgs: [experience.id],
    );
  }

  Future<int> delete(int id) async {
    final db = await _db.getDatabase();
    return db.delete('work_experience', where: 'id = ?', whereArgs: [id]);
  }
}
