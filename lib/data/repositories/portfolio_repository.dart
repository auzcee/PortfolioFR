// lib/data/repositories/portfolio_repository.dart
// ─────────────────────────────────────────────────────────────────────────────

import 'package:sqflite/sqflite.dart';
import 'package:portfolioph/data/datasources/local/database_service.dart';
import 'package:portfolioph/data/models/portfolio_model.dart';

class PortfolioRepository {
  final DatabaseService _db;

  PortfolioRepository({DatabaseService? databaseService})
    : _db = databaseService ?? DatabaseService();

  Future<int> insert(PortfolioModel portfolio) async {
    final db = await _db.getDatabase();
    return db.insert(
      'portfolios',
      portfolio.toMap(),
      conflictAlgorithm: ConflictAlgorithm.abort,
    );
  }

  Future<PortfolioModel?> findById(int id) async {
    final db = await _db.getDatabase();
    final rows = await db.query(
      'portfolios',
      where: 'id = ?',
      whereArgs: [id],
      limit: 1,
    );
    return rows.isEmpty ? null : PortfolioModel.fromMap(rows.first);
  }

  Future<List<PortfolioModel>> findByUserId(int userId) async {
    final db = await _db.getDatabase();
    final rows = await db.query(
      'portfolios',
      where: 'user_id = ?',
      whereArgs: [userId],
      orderBy: 'updated_at DESC',
    );
    return rows.map(PortfolioModel.fromMap).toList();
  }

  Future<int> update(PortfolioModel portfolio) async {
    final db = await _db.getDatabase();
    return db.update(
      'portfolios',
      portfolio.toMap(),
      where: 'id = ?',
      whereArgs: [portfolio.id],
    );
  }

  Future<int> delete(int id) async {
    final db = await _db.getDatabase();
    return db.delete('portfolios', where: 'id = ?', whereArgs: [id]);
  }
}
